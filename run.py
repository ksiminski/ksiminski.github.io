#!/bin/python3


from pybtex.database.input import bibtex

# https://docs.pybtex.org/api/parsing.html#bibliography-data-classes
# http://www.paolomonella.it/pybtex/index.html
 
def get_publications_html(plik):
    parser = bibtex.Parser()
    bib_data = parser.parse_file(plik)
    keys = bib_data.entries.keys()
    #print (bib_data.entries);
    #print (bib_data.entries.keys);
    
    for item in bib_data.entries :
        #print (item); 
        # print (bib_data.entries[item].key);
        napis = '';
        #print (bib_data.entries[item].persons['author']);
        for p in bib_data.entries[item].persons['author'] : 
            napis += ''.join(p.first()) + ''.join(p.last());
        napis += ' ' + bib_data.entries[item].fields['title'];
        print (napis);
        match (bib_data.entries[item].type):
            case 'article' :
                print ('article');
            case 'inproceedings' :
                print ('konferencja');
            case 'incollection' :
                print ('konferencja');    
            case _ :
                print (bib_data.entries[item].type);
                
        #print (bib_data.entries[item].type);
        #print (bib_data.entries[item].fields['title']); 
        
 
  
if __name__ == '__main__':
    wynik = get_publications_html("ksiminski.bib")
    print (wynik);
    
