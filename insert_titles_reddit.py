import MySQLdb.cursors
import json

db = MySQLdb.connect(host="capstone.cfiax0xaq0zu.us-west-1.rds.amazonaws.com", port=3306, user="stefancook", passwd="SCapril5", db="capstone", cursorclass=MySQLdb.cursors.DictCursor)

import requests

response = requests.get("https://www.reddit.com/r/entertainment/new.json", headers={'User-Agent': 'Mozilla/5.0'})
data = response.json()

for d in data["data"]["children"]:
    	# get raw json and exclude the first and last characters (the double quotes)
	title = json.dumps(d["data"]["title"])[1:-1]
    	print title
    	sql = "INSERT INTO reddit_temp SET titles = %s"
    	mysql_cursor = db.cursor()
    	mysql_cursor.execute(sql, [title])
    	db.commit()
