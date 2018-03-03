#!/bin/bash
ssh root@192.168.1.143 '/home/root/umbrella/audioCheck.pl && gst-launch-1.0 filesrc location=/home/root/umbrella/314104.wav ! wavparse ! pulsesink'
