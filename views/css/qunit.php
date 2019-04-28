<style>
/*!
 * QUnit 2.9.2
 * https://qunitjs.com/
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * https://jquery.org/license
 *
 * Date: 2019-02-21T22:49Z
 */

/** Font Family and Sizes */

#qunit-tests, #qunit-header, #qunit-banner, #qunit-testrunner-toolbar, #qunit-filteredTest, #qunit-userAgent, #qunit-testresult {
	font-family: "Helvetica Neue Light", "HelveticaNeue-Light", "Helvetica Neue", Calibri, Helvetica, Arial, sans-serif;
}

#qunit-testrunner-toolbar, #qunit-filteredTest, #qunit-userAgent, #qunit-testresult, #qunit-tests li { font-size: small; }
#qunit-tests { font-size: smaller; }


/** Resets */

#qunit-tests, #qunit-header, #qunit-banner, #qunit-filteredTest, #qunit-userAgent, #qunit-testresult, #qunit-modulefilter {
	margin: 0;
	padding: 0;
}


/** Header (excluding toolbar) */

#qunit-header {
	padding: 0.5em 0 0.5em 1em;

	color: #8699A4;
	background-color: #0D3349;

	font-size: 1.5em;
	line-height: 1em;
	font-weight: 400;

	border-radius: 5px 5px 0 0;
}

#qunit-header a {
	text-decoration: none;
	color: #C2CCD1;
}

#qunit-header a:hover,
#qunit-header a:focus {
	color: #FFF;
}

#qunit-banner {
	height: 5px;
}

#qunit-filteredTest {
	padding: 0.5em 1em 0.5em 1em;
	color: #366097;
	background-color: #F4FF77;
}

#qunit-userAgent {
	padding: 0.5em 1em 0.5em 1em;
	color: #FFF;
	background-color: #2B81AF;
	text-shadow: rgba(0, 0, 0, 0.5) 2px 2px 1px;
}


/** Toolbar */

#qunit-testrunner-toolbar {
	padding: 0.5em 1em 0.5em 1em;
	color: #5E740B;
	background-color: #EEE;
}

#qunit-testrunner-toolbar .clearfix {
	height: 0;
	clear: both;
}

#qunit-testrunner-toolbar label {
	display: inline-block;
}

#qunit-testrunner-toolbar input[type=checkbox],
#qunit-testrunner-toolbar input[type=radio] {
	margin: 3px;
	vertical-align: -2px;
}

#qunit-testrunner-toolbar input[type=text] {
	box-sizing: border-box;
	height: 1.6em;
}

.qunit-url-config,
.qunit-filter,
#qunit-modulefilter {
	display: inline-block;
	line-height: 2.1em;
}

.qunit-filter,
#qunit-modulefilter {
	float: right;
	position: relative;
	margin-left: 1em;
}

.qunit-url-config label {
	margin-right: 0.5em;
}

#qunit-modulefilter-search {
	box-sizing: border-box;
	width: 400px;
}

#qunit-modulefilter-search-container:after {
	position: absolute;
	right: 0.3em;
	content: "\25bc";
	color: black;
}

#qunit-modulefilter-dropdown {
	/* align with #qunit-modulefilter-search */
	box-sizing: border-box;
	width: 400px;
	position: absolute;
	right: 0;
	top: 50%;
	margin-top: 0.8em;

	border: 1px solid #D3D3D3;
	border-top: none;
	border-radius: 0 0 .25em .25em;
	color: #000;
	background-color: #F5F5F5;
	z-index: 99;
}

#qunit-modulefilter-dropdown a {
	color: inherit;
	text-decoration: none;
}

#qunit-modulefilter-dropdown .clickable.checked {
	font-weight: bold;
	color: #000;
	background-color: #D2E0E6;
}

#qunit-modulefilter-dropdown .clickable:hover {
	color: #FFF;
	background-color: #0D3349;
}

#qunit-modulefilter-actions {
	display: block;
	overflow: auto;

	/* align with #qunit-modulefilter-dropdown-list */
	font: smaller/1.5em sans-serif;
}

#qunit-modulefilter-dropdown #qunit-modulefilter-actions > * {
	box-sizing: border-box;
	max-height: 2.8em;
	display: block;
	padding: 0.4em;
}

#qunit-modulefilter-dropdown #qunit-modulefilter-actions > button {
	float: right;
	font: inherit;
}

#qunit-modulefilter-dropdown #qunit-modulefilter-actions > :last-child {
	/* insert padding to align with checkbox margins */
	padding-left: 3px;
}

#qunit-modulefilter-dropdown-list {
	max-height: 200px;
	overflow-y: auto;
	margin: 0;
	border-top: 2px groove threedhighlight;
	padding: 0.4em 0 0;
	font: smaller/1.5em sans-serif;
}

#qunit-modulefilter-dropdown-list li {
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

#qunit-modulefilter-dropdown-list .clickable {
	display: block;
	padding-left: 0.15em;
}


/** Tests: Pass/Fail */

#qunit-tests {
	list-style-position: inside;
}

#qunit-tests li {
	padding: 0.4em 1em 0.4em 1em;
	border-bottom: 1px solid #FFF;
	list-style-position: inside;
}

#qunit-tests > li {
	display: none;
}

#qunit-tests li.running,
#qunit-tests li.pass,
#qunit-tests li.fail,
#qunit-tests li.skipped,
#qunit-tests li.aborted {
	display: list-item;
}

#qunit-tests.hidepass {
	position: relative;
}

#qunit-tests.hidepass li.running,
#qunit-tests.hidepass li.pass:not(.todo) {
	visibility: hidden;
	position: absolute;
	width:   0;
	height:  0;
	padding: 0;
	border:  0;
	margin:  0;
}

#qunit-tests li strong {
	cursor: pointer;
}

#qunit-tests li.skipped strong {
	cursor: default;
}

#qunit-tests li a {
	padding: 0.5em;
	color: #C2CCD1;
	text-decoration: none;
}

#qunit-tests li p a {
	padding: 0.25em;
	color: #6B6464;
}
#qunit-tests li a:hover,
#qunit-tests li a:focus {
	color: #000;
}

#qunit-tests li .runtime {
	float: right;
	font-size: smaller;
}

.qunit-assert-list {
	margin-top: 0.5em;
	padding: 0.5em;

	background-color: #FFF;

	border-radius: 5px;
}

.qunit-source {
	margin: 0.6em 0 0.3em;
}

.qunit-collapsed {
	display: none;
}

#qunit-tests table {
	border-collapse: collapse;
	margin-top: 0.2em;
}

#qunit-tests th {
	text-align: right;
	vertical-align: top;
	padding: 0 0.5em 0 0;
}

#qunit-tests td {
	vertical-align: top;
}

#qunit-tests pre {
	margin: 0;
	white-space: pre-wrap;
	word-wrap: break-word;
}

#qunit-tests del {
	color: #374E0C;
	background-color: #E0F2BE;
	text-decoration: none;
}

#qunit-tests ins {
	color: #500;
	background-color: #FFCACA;
	text-decoration: none;
}

/*** Test Counts */

#qunit-tests b.counts                       { color: #000; }
#qunit-tests b.passed                       { color: #5E740B; }
#qunit-tests b.failed                       { color: #710909; }

#qunit-tests li li {
	padding: 5px;
	background-color: #FFF;
	border-bottom: none;
	list-style-position: inside;
}

/*** Passing Styles */

#qunit-tests li li.pass {
	color: #3C510C;
	background-color: #FFF;
	border-left: 10px solid #C6E746;
}

#qunit-tests .pass                          { color: #528CE0; background-color: #D2E0E6; }
#qunit-tests .pass .test-name               { color: #366097; }

#qunit-tests .pass .test-actual,
#qunit-tests .pass .test-expected           { color: #999; }

#qunit-banner.qunit-pass                    { background-color: #C6E746; }

/*** Failing Styles */

#qunit-tests li li.fail {
	color: #710909;
	background-color: #FFF;
	border-left: 10px solid #EE5757;
	white-space: pre;
}

#qunit-tests > li:last-child {
	border-radius: 0 0 5px 5px;
}

#qunit-tests .fail                          { color: #000; background-color: #EE5757; }
#qunit-tests .fail .test-name,
#qunit-tests .fail .module-name             { color: #000; }

#qunit-tests .fail .test-actual             { color: #EE5757; }
#qunit-tests .fail .test-expected           { color: #008000; }

#qunit-banner.qunit-fail                    { background-color: #EE5757; }


/*** Aborted tests */
#qunit-tests .aborted { color: #000; background-color: orange; }
/*** Skipped tests */

#qunit-tests .skipped {
	background-color: #EBECE9;
}

#qunit-tests .qunit-todo-label,
#qunit-tests .qunit-skipped-label {
	background-color: #F4FF77;
	display: inline-block;
	font-style: normal;
	color: #366097;
	line-height: 1.8em;
	padding: 0 0.5em;
	margin: -0.4em 0.4em -0.4em 0;
}

#qunit-tests .qunit-todo-label {
	background-color: #EEE;
}

/** Result */

#qunit-testresult {
	color: #2B81AF;
	background-color: #D2E0E6;

	border-bottom: 1px solid #FFF;
}
#qunit-testresult .clearfix {
	height: 0;
	clear: both;
}
#qunit-testresult .module-name {
	font-weight: 700;
}
#qunit-testresult-display {
	padding: 0.5em 1em 0.5em 1em;
	width: 85%;
	float:left;
}
#qunit-testresult-controls {
	padding: 0.5em 1em 0.5em 1em;
  width: 10%;
	float:left;
}

/** Fixture */

#qunit-fixture {
	position: absolute;
	top: -10000px;
	left: -10000px;
	width: 1000px;
	height: 1000px;
}
</style>
