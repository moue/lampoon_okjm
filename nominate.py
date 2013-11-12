import sys, urllib2, re, simplejson as json
from BeautifulSoup import BeautifulSoup, Tag


try:
    data = sys.argv[1]
except:
	print "error"
	sys.exit(1)

#append username to okcupid profile url
url = 'http://www.okcupid.com/profile?u='+data 

#grab html from url
page = urllib2.urlopen(url) 

#turn into soup object
soup = BeautifulSoup(page) 
#check that summary exists
essay = soup.find('div', {'id': 'essay_text_0'}) 

if (essay==None):
	print "error"
	sys.exit(1)
else:
	name = soup.find('span', {'id':'basic_info_sn'}).contents[0]
	
	num = 14 + len(name)
	summary = essay.renderContents() #grab user summary
	details = soup.title.string[num:] #grab user details
	pic = str(soup.img) #grab user picture
	src = str(soup.img['src']) #grab user picture img src
	
	# clean up main column content
	soup.find('div', {'id': 'what_i_want'}).extract()
	soup.find('div', {'id': 'whatiwant'}).extract()
	for each in soup.findAll('span'):
		each.extract()
		
	for e in soup.findAll('a', {'class': 'essay_title'}):
		tag = Tag(soup, "h4")
		title = e.string
		title = title.replace(u'\u2019', "'")
		tag.insert(1, title)
		e.replaceWith(tag)

	invalid_tags = ['a']

	everything = soup.find('div', {'id': 'main_column'}) #grab all essays from main column
	for tag in invalid_tags: 
		  for match in everything.findAll(tag):
		      match.replaceWithChildren()

	result = {'name': name, 'details': details, 'pic': pic, 'summary': summary, 'src':src, 'everything': str(everything)}
	print json.dumps(result)

