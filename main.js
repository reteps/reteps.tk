var casper = require('casper').create({verbose: true, logLevel: 'debug'});
casper.start('https://kahoot.it/#/');
casper.waitForSelector("#inputSession",
    function success() {
				
			casper.sendKeys('#inputSession', '906349');
			casper.click(".join");
      casper.echo(casper.getCurrentUrl());
      this.echo(this.page.content);
      this.echo('Page url is ' + this.getCurrentUrl());
    },
    function fail() {
        console.log("oops");
    });
casper.run();
