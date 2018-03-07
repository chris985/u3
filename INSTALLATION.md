# [Installation](#installation)
Simply upload the `u3` folder to `wp-content/themes/`, or wherever your themes are installed within Wordpress. Open `resources/style.css` and customize with your own information. (This is equivalent to the default Wordpress `style.css`). Then follow Sage installation steps: 
* Run `yarn` from the theme directory to install dependencies
* Update `resources/assets/config.json` settings: `devUrl` should reflect your local development hostname `publicPath` should reflect your WordPress folder structure (/wp-content/themes/sage for non-Bedrock installs)
* Happy Building!

## File Structure
* `/app/admin`, All of the Customizer features and options.
* `/app/setup`, Adds support for Wordpress features, and adds all your widget locations and options.
* `/resources/style.css`, This is your template file, as of version 1.0.0 change this to be the name of your theme.
* `/app/node_modules`, vendor These folders are for development only and contain different tools for compiling your theme. Remove them from your final theme.

Anything else, don't touch as it is crucial to proper working of the theme! These directories will be adjusted as development concludes.

## [Frequently Asked Questions (FAQs)](#faq)
### Is this compatible with xyz plugin?
Try it and see. It should be compatible with most any plugins out there. If needed, you can override the default Wordpress pages or custom plugin pages as normal.

### Why can't I customize the template/preview it without publishing it first?
I'm not sure. This is an issue with the Sage template that we build on top of. You could try asking them.

### How do I add my own CSS?
As of now there is only the customizer option. That will be expanded in the future.

### What about being able to show/collapse modules on a per-page basis?
There are a number of Wordpress plugins that do this option.  I like [Widget Options](https://wordpress.org/plugins/widget-options/), personally.

### How to make one element larger in a row? Or add custom column widths instead of all equal?
There are a number of Wordpress plugins that let you add custom css classes to Widgets. I like [Widget Options](https://wordpress.org/plugins/widget-options/), personally. Then just add your width class to the widget, example, `class="uk-width-2-3@m"` to double the size of a widget. By nature, the rest of the widgets will expand/contract automatically to fill the space, but you could also manually add classes to the other widgets in the position to ensure that anything else breaks onto a seperate row. 

This is better handled by a plugin due to many people not needing anything more than equal-width columns.

### It says the theme has updates, when I update it, my template is GONE.
Apparently, if you name your template anything that is used on the Wordpress theme directory and your version number is less than the version on the directory, it will notify you have an update for your template. DO NOT DO IT. The U3 framework is NOT updated in this way. If you proceed with the update, Wordpress will instead replace your theme files with those from the theme directory, essentially breaking your theme completely.

### How do I update the framework?
At this time, you don't. Unless there is a bugfix in which case you will manually need to copy files/folders to your theme. Simply replacing the files WILL overwrite your template changes! If you use the framework in its current state, build ontop of it and do not update it.

### Something I updated isn't changing.
There is a caching system in place. The cache folder is added to `wp-content/cache`. You will have to delete that folder sometimes for views to update properly.