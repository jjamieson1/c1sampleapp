#!/bin/bash
rsync -e ssh -azvp . root@10.192.1.2:/var/www/html/c1-sample-app/

