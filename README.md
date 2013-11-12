lampoon_okjm
============

2nd submissions for lampoon

Yuqi Hou
Quincy N304


Live version: https://www.hcs.harvard.edu/podcast/ok
Github: https://github.com/moue/lampoon_okjm


Description:
Purpose: Social roasting website where users can submit and poke fun at publically viewable OKCupid dating profiles. Users can deface pictures and personal essays.


Functionality: 
* Screen scraping: users submit OKCupid usernames. Nominations are handled via python screen scraping that grab publically viewable OKCupid dating profiles and deposit them in database
* Deface pictures: users can draw on pictures and save their drawings
* Edit essays: users can edit and save scraped personal essays. Users can view all versions of an edited essay as well as the original essay.
* Commenting: users can comment on scraped profiles 
* Dynamic pagination: all scraped profiles have their full profile page where all featured are implemented. 
* History: users can also see a full list of every profile that have been submitted to date 
* Featured profile: admin can optionally choose one profile to be featured on the main page
* Error handling: broken pages redirect to 404 missing page and most errors are handled via ajax.


List of implemented pages:
* https://www.hcs.harvard.edu/podcast/ok/index.php
* https://www.hcs.harvard.edu/podcast/ok/forum.php


Generated pages pass a GET parameter for the nid (unique id for an OKCupid profile) and a uname (the username of a registered site user). Examples below:
* https://www.hcs.harvard.edu/podcast/ok/index.php?nid=35
* https://www.hcs.harvard.edu/podcast/ok/index.php?nid=35&uname=admin1


Premade accounts:
username | password

	admin  | admin
	zippy  | zippy
	mrman  | mrman

Known bugs: slow computers will experience slow page loading times. Since all javascript functions are loaded at the very end, after all DOM elements have loaded, it is possible that a button or a feature will take longer to do what you expect it to do. The workaround is a wait until the page has fully loaded before trying many functions. 


Any special setup instructions: pressing enter works for log in / sign up / nominate for chrome and firefox. This was intentional, but FYI: editing the same essay will overwrite any previously saved essays attached to that specific profile and your specific account. 


Link to first project website: http://www.hcs.harvard.edu/podcast/sports/
