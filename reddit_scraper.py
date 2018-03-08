import MySQLdb.cursors
import json
import datetime

db = MySQLdb.connect(host="capstone.cfiax0xaq0zu.us-west-1.rds.amazonaws.com", port=3306, user="stefancook", passwd="SCapril5", db="capstone", cursorclass=MySQLdb.cursors.DictCursor)

import requests

response = requests.get("https://www.reddit.com/r/entertainment/hot.json", headers={'User-Agent': 'Mozilla/5.0'})
data = response.json()
response1 = requests.get("https://www.reddit.com/r/movies/hot.json", headers={'User-Agent': 'Mozilla/5.0'})
data1 = response1.json()
response2 = requests.get("https://www.reddit.com/r/television/hot.json", headers={'User-Agent': 'Mozilla/5.0'})
data2 = response2.json()


def getComments(comments_link):
	comments = []
	test = requests.get(comments_link, headers={'User-Agent': 'Mozilla/5.0'}).json()
	for t in test[1]["data"]["children"][:5]:
		comments.append((t["data"]["body"]))
	return comments

for d in data["data"]["children"]:
	link_id = d["data"]["name"]
	permalink = d["data"]["permalink"]
	comments_link = 'http://reddit.com' + permalink + '.json'
	comments = getComments(comments_link)
	title = json.dumps(d["data"]["title"])[1:-1]
	thumbnail = json.dumps(d["data"]["thumbnail"])[1:-1]
	title_fixed = title.decode('unicode_escape')
	timecode = json.dumps(d["data"]["created"])
	timestamp = datetime.datetime.fromtimestamp(float(timecode)).strftime('%Y-%m-%d %H:%M:%S')
	url = json.dumps(d["data"]["url"])[1:-1]
	print timestamp, title_fixed, url, thumbnail, link_id
	sql = "INSERT INTO r_ent SET timecode = %s, titles = %s, url = %s, thumbnail = %s, link_id = %s"
	for comment in comments:
		print comment, link_id
	if len(comments)>0:
		sql_comment = "INSERT INTO ent_comments SET content = %s, link_id = %s"
	mysql_cursor = db.cursor()
	mysql_cursor.execute(sql, [timestamp, title, url, thumbnail, link_id])
	mysql_cursor.execute(sql_comment, [comment, link_id])
	db.commit()

for d in data1["data"]["children"]:
	link_id1 = d["data"]["name"]
 	permalink1 = d["data"]["permalink"]
	comments_link1 = 'http://reddit.com' + permalink1 + '.json'
 	comments1 = getComments(comments_link1)
 	title1 = json.dumps(d["data"]["title"])[1:-1]
 	thumbnail1 = json.dumps(d["data"]["thumbnail"])[1:-1]
 	title_fixed1 = title1.decode('unicode_escape')
 	timecode1 = json.dumps(d["data"]["created"])
	timestamp1 = datetime.datetime.fromtimestamp(float(timecode1)).strftime('%Y-%m-%d %H:%M:%S')
	url1 = json.dumps(d["data"]["url"])[1:-1]
	print timestamp1, title_fixed1, url1, thumbnail1, link_id1
 	sql1 = "INSERT INTO r_mov SET timecode = %s, titles = %s, url = %s, thumbnail = %s, link_id = %s"
 	for comment in comments1:
 		print comment, link_id1
 	if len(comments1)>0:
 		sql_comment1 = "INSERT INTO mov_comments SET content = %s, link_id = %s"
 	mysql_cursor = db.cursor()
 	mysql_cursor.execute(sql1, [timestamp1, title1, url1, thumbnail1, link_id1])
 	mysql_cursor.execute(sql_comment1, [comment, link_id1])
 	db.commit()

for d in data2["data"]["children"]:
	link_id2 = d["data"]["name"]
 	permalink2 = d["data"]["permalink"]
	comments_link2 = 'http://reddit.com' + permalink2 + '.json'
 	comments2 = getComments(comments_link2)
 	title2 = json.dumps(d["data"]["title"])[1:-1]
 	thumbnail2 = json.dumps(d["data"]["thumbnail"])[1:-1]
 	title_fixed2 = title2.decode('unicode_escape')
 	timecode2 = json.dumps(d["data"]["created"])
	timestamp2 = datetime.datetime.fromtimestamp(float(timecode2)).strftime('%Y-%m-%d %H:%M:%S')
	url2 = json.dumps(d["data"]["url"])[1:-1]
	print timestamp2, title_fixed2, url2, thumbnail2, link_id2
 	sql2 = "INSERT INTO r_tv SET timecode = %s, titles = %s, url = %s, thumbnail = %s, link_id = %s"
 	for comment in comments2:
 		print comment, link_id2
 	if len(comments2)>0:
 		sql_comment2 = "INSERT INTO tv_comments SET content = %s, link_id = %s"
 	mysql_cursor = db.cursor()
 	mysql_cursor.execute(sql2, [timestamp2, title2, url2, thumbnail2, link_id2])
 	mysql_cursor.execute(sql_comment2, [comment, link_id2])
 	db.commit()
