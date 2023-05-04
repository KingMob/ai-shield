#!/usr/bin/env zsh

zip -r ai-shield ai-shield
zip -d ai-shield.zip 'ai-shield/.idea/*' '*/.DS_Store' # can't seem to get --exclude working...
