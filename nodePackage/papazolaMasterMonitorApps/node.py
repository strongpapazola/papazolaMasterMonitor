#!/usr/bin/python3
import sys
import subprocess
import json

def shell(cmd):
#    a = subprocess.Popen('echo bringiton040902 | sudo -S '+str(cmd), shell=True, stdout=subprocess.PIPE).stdout.read().decode('utf-8')
    a = subprocess.Popen(str(cmd), shell=True, stdout=subprocess.PIPE).stdout.read().decode('utf-8')
    return a

def config():
	a = json.loads(shell('cat config.json'))
	return a

def ssh_loggedin():
	res = []
	portssh = config()['port_ssh']
	a = shell('lsof -i :%s | grep ESTABLISHED' % (portssh,))
	a = shell('lsof -i :%s ' % (portssh,))
	a = a.splitlines()
	for i in a:
		k = []
		i = i.split(' ')
		for j in range(0, len(i)):
			if i[j]:
				k.append(i[j])
		res.append(k)
	if res:
		if res[1][9]:
			res[0].append('STATUS')
		if res[1]:
			for i in range(0, len(res)):
				res[i].pop(3)
				res[i].pop(4)
				res[i].pop(4)
	return res

def check_storage():
	res = []
	a = shell('df -t ext4 -lh')
	a = a.splitlines()
	for i in a:
		k = []
		i = i.split(' ')
		for j in range(0, len(i)):
			if i[j]:
				k.append(i[j])
		res.append(k)
	if res[0][-1]:
		res[0].pop(-1) #clearing data
	return res

def portopened():
	res = []
	a = shell('netstat -tulnp')
	a = a.splitlines()
	for i in a:
		k = []
		i = i.split(' ')
		for j in range(0, len(i)):
			if i[j]:
				k.append(i[j])
		res.append(k)
	if res:
		res.pop(1)
		res.pop(0)
		for i in range(0, len(res)):
			res[i].pop(1)
			res[i].pop(1)
	return res

def time():
	a = shell('date')
	a = a.splitlines()
	a = a[0]
	return a

def memory_usage():
	res = []
	a = shell('free -h')
	a = a.splitlines()
	for i in a:
		if i:
			res.append(i)
	res1 = []
	for i in res:
		res2 = []
		i = i.split(' ')
		for j in i:
			if j:
				res2.append(j)
		res1.append(res2)
	res1[0].pop(3)
	res1[0].pop(3)
	res1[0].pop(3)
	res1[1].pop(0)
	res1[1].pop(2)
	res1[1].pop(2)
	res1[1].pop(2)
	res1[2].pop(0)
	return res1

webdir = config()['webdir']

def command_check():
	a = shell('cat '+str(webdir)+'/check.json').splitlines()[0]
	a = json.loads(a)['run']
	return a

try:
	while True:
		if command_check() == "true":
			res = []
			res.append(time())
			res.append(memory_usage())
			res.append(check_storage())
			res.append(ssh_loggedin())
			res.append(portopened())
			res = json.dumps(res)
			shell('echo \'%s\' > %s/result.json' % (res,webdir,))
except Exception as e:
	error = str(e)
	# print(error)
	shell('echo \'%s\' > %s/result.json' % (error,webdir,))



# def get_url():
# 	import requests
# 	user_agent = 'foo'
# 	url = "http://localhost/papazolaMasterMonitor/check.json"
# 	s = requests.Session()
# 	s.headers['User-Agent'] = user_agent
# 	r = s.get(url, allow_redirects=True, timeout=10).text
# 	r = json.loads(r)
# 	return r