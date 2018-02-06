# U3 Starter Theme
U3 is an Wordpress Starter Theme based on the UIKit3+ framework by YooTheme. It aims to bring back a traditional template workflow and integrate some new features along the way. One can think of U3 Starter Theme as the never released yoo_master3, since YooTheme decided to butcher the system and make it pay-to-play.

YooTheme had my heart and broke it. The developers are hard-headed about listening to any feedback, support is abysmal, it often takes weeks for simple bugfixes, and many months between new releases with questionable new features. The new YooTheme Pro was the final nail in the coffin. Not only does it destroy the workflow and make it nearly impossible for developers to actually build a site, it gets in your way and overcomplicates everything along the way. Oh, and there's no free yoo_master anymore, so you are forced to use UIKit2 on your beautiful modern themes or sacrifice the beauty that is UIKit 3... -Well, no more!

Introducting U3, named after the never released yoo_master3, a minimalistic template engine that brings all the UiKit3 goodness to Wordpress with a number of sleek modern enhancements including the Blade template engine from Laravel, shortcodes for your favorite components, CSS and JS compression and minification, and integration with standard Wordpress functions whenever possible.

While Yootheme probably dislikes this project, as UIkit itself is released under the MIT license, and no parts of the Yootheme Pro or even the yoo_master template are used in its creation, the U3 project should be kosher.

## What's New?
The latest build overhauls the widget settings to be array based for faster and more efficient processing as well as the ability to add your own widgets. This is extremely alpha. You can play with the options under "Layouts". You must add your list, comma-seperated, in the order you want the items to appear on the page. Then save and refresh the customizer screen to get two additional options for the amount of spacing and container associated with that widget. Early testing has proven it safe and functional at the minimum, although it needs extensive testing as well as some polishing.

## Features
* A smart, nimble, flexible, and feature-packed template framework
* Smarty template engine
* DRY principles wherever possible
* CSS/SCSS/JS minification
* Moves core functionality to plugins wherever possible
* Smartcodes for all your favorite UIKit3 elements
* Easily override default Wordpress templates or plugins

## Installation
Simply upload the `u3` folder to `wp-content/themes/`, or wherever your themes are installed within Wordpress. Open `resources/style.css` and customize with your own information. (This is equivalent to the default Wordpress `style.css`). Then follow Sage installation steps: 
* Run `yarn` from the theme directory to install dependencies
* Update `resources/assets/config.json` settings: `devUrl` should reflect your local development hostname `publicPath` should reflect your WordPress folder structure (/wp-content/themes/sage for non-Bedrock installs)
* Happy Building!

### File Structure
* `/app/admin`, All of the customizer features and options.
* `/app/setup`, Adds support for Wordpress features, and adds all your widget locations and options.
* `/resources/style.css`, This is your template file, as of version 1.0.0 change this to be the name of your theme. Check FAQ for note. 
* `/app/node_modules`, vendor These folders are for development only and contain different tools for compiling your theme. Remove them from your final theme.

Anything else, don't touch as it is crucial to proper working of the theme! These directories will be adjusted as development concludes.

## Support
Please use Github to report any issues or contribute to the project yourself with bugfixes or new features. I am a newbie and I am learning as I go. I saw the need for this personally and am releasing it freely for anyone that can use it or wants to help the project and build upon it.

### FAQ

#### Is this compatible with xyz plugin?
Try it and see. It should be compatible with most any plugins out there. If needed, you can override the default Wordpress pages or custom plugin pages as normal.

#### Why can't I customize the template/preview it without publishing it first?
I'm not sure. This is an issue with the Sage template that we build on top of. You could try asking them.

#### How do I add my own CSS?
As of now there is only the customizer option

#### What about being able to show/collapse modules on a per-page basis?
There are a number of Wordpress plugins that do this option.  I like [Widget Options](https://wordpress.org/plugins/widget-options/), personally.

#### How to make one element larger in a row? Custom column widths instead of all equal?
There are a number of Wordpress plugins that let you add custom css classes to Widgets. I like [Widget Options](https://wordpress.org/plugins/widget-options/), personally. Then just add your width class to the widget, example, `class="uk-width-2-3@m"` to double the size of a widget. By nature, the rest of the widgets will expand/contract automatically to fill the space, but you could also manually add classes to the other widgets in the position to ensure that anything else breaks onto a seperate row. This is better handled by a plugin due to many people not needing anything more than equal-width columns.

#### It says the theme has updates, when I update it, the template is GONE.
Apparently, if you name your template anything that is used on the Wordpress theme directory and your version number is less than the version on the directory, it will notify you have an update for your template. DO NOT DO IT. The U3 framework is NOT updated in this way. If you proceed with the update, Wordpress will instead replace your theme files with those from the theme directory, essentially breaking your theme completely.

#### How do I update the framework?
At this time, you don't. Unless there is a bugfix in which case you will manually need to copy files/folders to your theme. Simply replacing the files WILL overwrite your template changes!

#### Something I updated isn't changing.
There is a caching system in place. The cache folder is added to `wp-content/cache`. You will have to delete that folder sometimes for views to update properly.

### Roadmap
Full steam ahead to 1.0.0 which will be the first official release that should be suitable for a production enviroment. In this version, you will be building directly over the template, making all of your changes withing the core files... yuck. Version 2.0.0 will introduce child themes where the U3 framework will act as a parent and your overrides are done within a child theme, allowing us to update the U3 framework at any time to add new features and enhancements, similar to most other template engines out there. Eventually, we hope to expand the codebase to include Joomla and Drupal as well, but those are questionable and way down the line.

## Credits
* [Christopher Martone](http://christophermartone.com)
* [Sage Template Starter](https://roots.io/sage/)
* [Laravel Blade](https://laravel.com/docs/master/blade)
* [UIKit](https://getuikit.com/)
* [YooTheme](https://yootheme.com/)

## License
````Copyright (c) YOOtheme GmbH

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.````