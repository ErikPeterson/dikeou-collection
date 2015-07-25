Dikeou Collection CMS Manual
============================


#Introduction

Dikeou Collection's CMS is built on Wordpress, allowing easy creation of new posts and pages. To log in to the CMS backend, navigate to `dikeoucollection.com/wp-admin` and log in with the provided credentials.

When you first log in, you will be presented with the Wordpress dashboard. The central panel contains sever informational modules that you will not need to inderact with. The left sidebar contains a list of menus for navigating the CMS.

#Sidebar Menu

From top to bottom:

- **Dashboard** Click to return to the Dashboard page. Hover to view menu items.
	- **Home** Click to return to the Dashboard page.
	- **Updates** Click to view available Wordpress updates. Do not change the settings in here or start an update without assistance of a developer.
- **Media** Click to view the Media Library. Hover to view menu items.
	- **Library** The media library is an index of all the images uploaded to Dikeou Collection.
	- **Add New** Upload a new image.
- **Pages** Click to view a listing of all pages. Hover to view menu items.
	- **All Pages** View a listing of all pages.
	- **Add New** Add a new page.
- **Artists** Click to view a listing of all artist posts. Hover to view menu items.
	- **Artists** Full artist posts listing.
	- **Add New** Add a new artist post.
- **Events** Click to view a listing of all event posts. Hover to view menu items.
	- **Events** Full event posts listing.
	- **Add New** Add a new event post.
- **Users** Click to see a listing of all users on the site. Hover to view menu.
	- **All Users** Listing of all users.
	- **Add New** Add a new user to the wordpress CMS.
	- **Your Profile** Edit your user profile.
- **Settings** Click to see general settings. Hover to view menu options.
	- **General** Overall site settings.
	- **Imagemagick Settings** Settings for image processing on the whole site. Do not alter without developer assistance.


#Pages

The static pages of the Dikeou Collection site are managed through the Pages section. The routing of the site depends on the names of these pages, so it is best not to change them.

To edit the content of a page, find it in the Pages index by clicking the Pages link in the left menu, then click the page's title. Once you've finished making your changes, you can publish them to the site by clicking the 'Update' button in the Publish module in the upper right of the editor page.

##About Page

The About page is composed of a single, What You See Is What You Get (WYSIWYG) content field. Text can be entered into the field directly and formatted with the tools at the top of the bar. 

To add an image, click the 'Add Media' button above the content field. You can choose an image from the Media Library, or upload a new one by dragging the file onto the media library popover.

##Contact Page

The Contact page editor has several distinct content fields for the different sections of the page. The main contact content is entered in he top field, content for insertion below the map is entred in the 'Location Content' field, and content related to teh Internship program should go in the 'Internship Content' field.


#Artist Posts

The artist post ediotr has a number of special fields to facilitate creation of artist posts. When you have finished creating a new post, click the Publish button in the upper right to make the post live. If you are editing an existing post, the Publish button will instead be an Update button.

##Title

The first field is the title of the post, which should be the name of the artist. The name of the post is used to construct the URL, so an artists post titled "Frank Stella" will be available at the route `/artists/frank-stella`. 

##Slug

Once you've set the title, you can still change the URL with the Slug field below the title. The slug is the last part of the URL, must be unique, and should be lower case letters and dashes only.

##Artist Statement & Curator Statement

The content for the Artist & Curator Statement modules should be entered in these fields. It's best to stick to plain text and basic formatting like bold and italic, which are available in the top bar of the editor field.

##Zing Magazine Links

This section can be used to add links to Zing Magazine issues. To add a new link, click the Add Link button. You can add as many links as needed in this manner. The Link Text will be displayed in the 'Zing Issues' dropdown on the post. The link URL should be the full URL of the page to link to, including the http://

##Artist Site URL

The Artist site URL field shoudl be populated with the full URL to the Artist's website, including the http://

##Galleries

Each artist can have as many Galleries (slideshows) as needed. To add a Gallery to the post, click the Add Gallery button. Each time you click this button a new slideshow module will be added to the page.

To add a slide to a gallery, click the 'Add Slide' button. This will open a slide editor panel. To select the slide's image, click the 'Add Image' button. This will open a popover for the media library, where you can either choose an existing image, or drag a new file in to upload it.

The slide title and slide caption are optional. The slide title formatting is fixed, so do not enter HTML or other formatting in the field. The Slide Caption can be formatted with basic text styles like bold and italic, whcih are available in the top bar of the editor field.

Repeat this process as many times as needed to add slides to the gallery. The numbers on the far left of the gallery table indicate the order of the galleries. To reorder, you can drag the gallery's number up or down. Slides can be reordered within their gallery by dragging the number to the left of the slide's editor module.


#Event Posts

The Event Post editor functions similarly to the Artist post editor, with a number of custom fields to facilitate the special content of these posts. When you have finished creating a new post, click the Publish button in the upper right to make the post live. If you are editing an existing post, the Publish button will instead be an Update button.

##Title 

This is the title of the event, which runs above the description and to the right of the event image on the events listing page. 

##Content

The content of the event description should be entered in the main editor field for the post, just below the title. ALl formatting options are available, as is the upload media button. To preserve the layout of the events listing page and individual event posts, it is best to refrain from using any of the editor features other than the basic text formatting tools.

##Event Date

This field will open a calendar-style datepicker when clicked. Events are organized by their date, so this field is required in order to publish an event post. The field, when not open to the datepicker calendar, will display the event date in the format DD/MM/YYYY. 

##Event Time

The event time field allows you to enter the text that will run above the event image in the event listing page (e.g. 7/1/15 4:30 PM).

##Event Video URL

You may enter an event video url here, which will be linked to below the event description on the listing page and individual event post.

##Galleries

The functionality of the event galleries is identical to that of the artist galleries. Please refer to the instructions in the Arist Posts section for details on using this feature.

##Featured Image

The featured image module allows you to select the image that will be used for the event in the event listing page. Click 'Set featured image' to open the media library module. Here you may select an existing image to use, or upload a new one by dragging the file onto the media library module.

