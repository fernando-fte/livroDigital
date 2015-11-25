temp = {}
temp.book = '<?xml version="1.0" encoding="UTF-8"?><book><info>Informação</info></book>'
temp.xml = $.parseXML temp.book
console.log $(temp.xml).find('info').text()
