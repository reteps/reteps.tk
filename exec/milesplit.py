#!/usr/bin/env python3

import requests, sys
from bs4 import BeautifulSoup as soup
CATEGORIES = ["","article","athlete","meet","team","video"]
MILESPLIT = "http://milesplit.com"
SEARCH_URL = "http://milesplit.com/search?q={}+{}&category={}"
ATHLETE_URL = "http://milesplit.com/athletes/pro/{}/stats"
PERFORMANCE_URL = "http://milesplit.com/athletes/{}/performances/{}"
class NotValid(Exception):
    pass


def search_for(item, category="",state=""):
    parsed_item = item.replace(" ","+")
    parsed_category = category.lower()
    if parsed_category not in CATEGORIES:
        raise NotValid("invalid search category")
    if item == "":
        raise NotValid("invalid search term")
    page = soup(session.get(SEARCH_URL.format(parsed_item,state,parsed_category)).content,"html.parser")
    raw_results = page.find("div",{"class":"searchResults"}).find("ul").findAll("li")
    results = []
    for raw_result in raw_results:
        raw_link = raw_result.find("a",{"class":"title"})
        link = MILESPLIT + raw_link["href"]
        id = raw_link["href"].split("/")[-1]
        descrip = raw_result.find("div",{"class":"description"}).text.strip()
        result_type = raw_result.find("span",{"class":"type"}).text.strip()
        result = raw_link.text.strip()
        results.append({"result":result,"link":link,"id":id,"description":descrip,"type":result_type})
    return results

def lookup_athlete(id,prefix="time",html=False):
    info = {}
    page = soup(session.get(ATHLETE_URL.format(id)).content,"html.parser")

    team_data = page.find("div",{"class":"team"})
    name = page.find("h1").text.strip().replace("\n"," ")
    try:
        class_of = team_data.find("span",{"class":"grade"}).text.strip().split("Class of ")[1]
    except AttributeError:
        class_of = 'N/A'
    city = team_data.find("span",{"class":"city"}).text.strip()
    school = team_data.find("a").text.strip()
    school_link = team_data.find("a")["href"]
    info["about"] = {"name":name,"class":class_of,"city":city,"school":school,"school_link":school_link}
    info["records"] = []
    for record in page.find("div",{"class":"bests"}).find("ul").findAll("li"):
        pr = record.text.strip().split(" - ")
        info["records"].append({"event":pr[0],prefix:pr[1]})

    info["events"] = {}
    races = page.find("table",{"class":"performances"}).find("tbody").findAll("tr")
    current_section = ""
    for race in races:
        if "thead" in race["class"]:
            if race["class"] == ["thead"]:
                current_section = race.find("th",{"class":"event"}).text.strip()
                info["events"][current_section] = []
        else:
            when = race.find("time",{"class":"start"}).text.strip()
            place = race.find("td",{"class":"place"}).text.strip()
            name = race.find("td",{"class":"meet"}).text.strip()
            page_time = race.findAll("a")[-1]["href"]
            page = soup(session.get(MILESPLIT+page_time).content,"html.parser")
            score = page.find("div",{"class":"mark"}).find("span").text.strip()
            info["events"][current_section].append({"name":name,"date":when,"place":place,prefix:score})
    if html:
        return to_html(info,prefix)
    else:
        return info
def to_html(results,prefix):
    info = '<table>\n<tr>\n<th>Name</th>\n<th>Class of</th>\n<th>City</th>\n<th>School</th>\n</tr>\n<tr>\n'
    records = '<table>\n<tr>\n<th>Event</th>\n<th>Record</th>\n</tr>\n'
    events = '<table>\n<tr>\n<th>Name</th>\n<th>Date</th>\n<th>Place</th>\n<th>{}</th>\n</tr>\n'.format(prefix.title())
    aresults = results["about"]
    info_data = [aresults["name"],aresults["class"],aresults["city"],"<a href={}>{}</a>".format(aresults["school_link"],aresults["school"])]
    for item in info_data:
        info += "<td>{}</td>\n".format(item)
    info += "</tr>\n</table>"

    for record in results["records"]:
        records += "<tr>\n<td>{}</td>\n<td>{}</td>\n</tr>\n".format(record["event"],record[prefix])
    records += "</table>"
    for event in results["events"].keys():
        events += "<tr>\n<th colspan='4'>{}</th>\n</tr>\n".format(event)
        for race in results["events"][event]:
            content = ""
            for header in race.keys():
                content += "<td>{}</td>\n".format(race[header])
            events += "<tr>\n{}</tr>\n".format(content)
    events += "</table>"
    return "<br>".join([info,records,events])
if __name__ == '__main__':
    session = requests.Session()
    results = search_for(' '.join(sys.argv[1:]),category="athlete")
    if results[0]["type"] == "athlete":
        about = lookup_athlete(results[0]["id"],html=True)
        css = '<style>\ntable, td, tr, th {\nborder:1px solid black;\nborder-collapse:collapse;\npadding:10px;\n}\n</style>\n'
        print(css + about)
    else:
        print("Not an Athlete.")
