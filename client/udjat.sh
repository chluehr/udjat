#!/bin/bash
# -------------------------------------------------------------------

# Default udjat config url:
UDJAT_URL=http://localhost/data/post/
UDJAT_APIKEY=secret_key

CLIENT_PATH=`dirname $(cd ${0%/*} && echo $PWD/${0##*/})`

# Include defaults if available
if [ -f $CLIENT_PATH/udjat.conf ] ; then
    . $CLIENT_PATH/udjat.conf
fi

# header
D='UDJAT/1.0'

# hostname
D="${D}\nhost `uname -n`"

# SystemLoad:
D="${D}\n`uptime |sed -r -e's/.* ([0-9.]+), ([0-9.]+), ([0-9.]+).*/load1 \1,load5 \2,load15 \3/'`"

# Swapinfo
D="${D}\n`free -m |grep -E Swap |sed -r -e 's/Swap: *([0-9]+) *([0-9]+) *([0-9]+).*/SwapTotal \1,SwapUsed \2,SwapFree \3/'`"

# @todo use a single call to "free"
MEM_FREE=`free    -m |grep -E Mem |sed -r -e 's/Mem: *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+)/\3/'`
MEM_USED=`free    -m |grep -E Mem |sed -r -e 's/Mem: *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+)/\2/'`
MEM_BUFFERS=`free -m |grep -E Mem |sed -r -e 's/Mem: *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+)/\5/'`
MEM_SHARED=`free  -m |grep -E Mem |sed -r -e 's/Mem: *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+)/\4/'`
MEM_CACHED=`free  -m |grep -E Mem |sed -r -e 's/Mem: *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+) *([0-9]+)/\6/'`

MEM_USED=$(($MEM_USED - $MEM_BUFFERS - $MEM_SHARED - $MEM_CACHED))

D="${D}\nMemUsed $MEM_USED"
D="${D}\nMemShared $MEM_SHARED"
D="${D}\nMemBuffers $MEM_BUFFERS"
D="${D}\nMemCached $MEM_CACHED"
D="${D}\nMemFree $MEM_FREE"

# diskspace (in percent) - only /dev/sd* devices for now!
D="${D}\n`df |grep '/dev/sd' |sed -r -e 's#/dev/##' -e 's#  +# #g' -e 's#%##' |cut -d' ' -f1,5 `"

# number of processes
D="${D}\nprocesses `ps xa|wc -l `"

# debug_
echo -e $D | tr "," "\n" 

# concat some parameters and post it
echo -e $D | tr "," "\n" | curl --data-binary @/dev/stdin "$UDJAT_URL?api_key=$UDJAT_APIKEY"

# eof
