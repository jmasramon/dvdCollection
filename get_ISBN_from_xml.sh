while read line; do xml2json < $line | jq . | grep -A 2 UPC | grep t | sed 's/:/,/' | csvcut -c 2; done < partial.txt