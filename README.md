# binky

Binky is a simple html email template engine, inspired by [Inky](https://github.com/zurb/inky), an email template tool from Zurb.

Binky does a simple search and replace of tags like &lt;container&gt;, and replaces them with the more complex table structure for HTML emails. It is customizable, so while it comes with a basic configuration, you can customize it with your own template tags and replacement rules.

Note that Binky does not do CSS style inlining - it is purely search and replace templating solution.

Binky was created to work with PHP 5.1+.

IMPORTANT: Requires [Pharse](https://github.com/ressio/pharse/) for HTML parsing.

## References

* https://templates.mailchimp.com/getting-started/html-email-basics/
* https://www.emailonacid.com/blog/article/email-development/email-development-best-practices-2/
* https://beefree.io/editor/

## To Do

* Add &lt;button&gt; element
* Add responsive email config

