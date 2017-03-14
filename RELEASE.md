Box (which generates the phar file) binary should be included in the vendor since it's in the `require-dev` deps.

* Open the project directory and run `./vendor/bin/box build`
* There will be a new file `git-profile.phar` at the root of the project.
* Use this generated phar file `git-profile.phar` to test if everything is working as expected.
* Make a new release and upload the generated phar file
