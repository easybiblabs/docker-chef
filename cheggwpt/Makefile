
.PHONY: all build test tag_latest release ssh

all: alpine basics services

alpine:
	@$(MAKE) -C ./alpine-3.4 all
	@$(MAKE) -C ./alpine-edge all

basics:
	@$(MAKE) -C ./ruby all
	@$(MAKE) -C ./java all
	@$(MAKE) -C ./redis all
	@$(MAKE) -C ./nginx all
	@$(MAKE) -C ./nginx-php7 all

services:
	@$(MAKE) -C ./fakes3 all
	@$(MAKE) -C ./fakesqs all
	@$(MAKE) -C ./languagetool all
	@$(MAKE) -C ./phpredisadmin all
	@$(MAKE) -C ./nginx-php7-office all

release:
	@$(MAKE) -C ./alpine-3.4 release
	@$(MAKE) -C ./alpine-edge release
	@$(MAKE) -C ./ruby release
	@$(MAKE) -C ./java release
	@$(MAKE) -C ./redis release
	@$(MAKE) -C ./nginx release
	@$(MAKE) -C ./nginx-php7 release
	@$(MAKE) -C ./fakes3 release
	@$(MAKE) -C ./fakesqs release
	@$(MAKE) -C ./languagetool release
	@$(MAKE) -C ./phpredisadmin release
	@$(MAKE) -C ./nginx-php7-office release

