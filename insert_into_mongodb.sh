# !/bin/bash #
single=$(cat single_item.json ); mongo ramon --eval "db.dvds.insert($single);"