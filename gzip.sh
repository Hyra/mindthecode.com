#!/bin/bash

find _site/ -iname '*.html' -exec gzip -n {} +
find _site/ -iname '*.js' -exec gzip -n {} +
find _site/ -iname '*.css' -exec gzip -n {} +
find _site/ -iname '*.gz' -exec rename 's/\.gz$//i' {} +