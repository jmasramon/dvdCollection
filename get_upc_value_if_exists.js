var myCursor = db.dvds.find({'ItemSearchResponse.Items.Item.ItemAttributes.UPC': {$exists: true}},{'ItemSearchResponse.Items.Item.ItemAttributes.Title':1,'ItemSearchResponse.Items.Item.ItemAttributes.UPC':1, _id:0});
while (myCursor.hasNext()){ 
    var current = myCursor.next();
    if (current.ItemSearchResponse.Items.Item.length >  1) {
        print('first elem');
        print(tojson(current.ItemSearchResponse.Items.Item[0]));
        //print(current.ItemSearchResponse.Items.Item[0].ItemAttributes.Title.t, ':',current.ItemSearchResponse.Items.Item[0].ItemAttributes.UPC.t);
    } else {
        print('single elem');
        print(tojson(current.ItemSearchResponse.Items.Item));
        // print(tojson(current.ItemSearchResponse.Items.Item.ItemAttributes.Title.t, ':',current.ItemSearchResponse.Items.Item.ItemAttributes.UPC.t));
    }
}
