import sys, urllib2, re
from BeautifulSoup import BeautifulSoup, Tag

soup = BeautifulSoup("<b>Argh!<a>Foo</a></b><i>Blah!</i>")
tag = Tag(soup, "newTag", [("id", 1)])
tag.insert(0, "Hooray!")
soup.a.replaceWith(tag)
print soup
# <b>Argh!<newTag id="1">Hooray!</newTag></b><i>Blah!</i>

url = 'http://www.okcupid.com/profile?u=Tuesdaythe5th'

#grab html from url
page = urllib2.urlopen(url) 
soup = BeautifulSoup(page)
essay = soup.find('div', {'id': 'essay_0'}) 

print essay
print essay.a.contents

a_tag = essay.a
new_tag = Tag(essay, "b")
#new_tag.string = "example.net"
a_tag.replace_with(new_tag)

invalid_tags = ['a']

for tag in invalid_tags: 
    for match in essay.findAll(tag):
        match.replaceWithChildren()
print essay



