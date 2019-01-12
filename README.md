<div align="center">
    <h1 align="center">git-profile</h1>
    <p align="center">
      <a href="https://travis-ci.org/ziishaned/git-profile">
          <img src="https://img.shields.io/travis/ziishaned/git-profile/master.svg?style=flat-square" alt="Build Status"/>
      </a>
      <a href="https://github.com/ziishaned/git-profile/releases">
          <img src="https://img.shields.io/github/release/ziishaned/git-profile.svg?style=flat-square" alt="Latest Version"/>
      </a>
      <a href="https://twitter.com/home?status=git-profile%20by%20%40ziishaned%20http%3A//github.com/ziishaned/git-profile">
        <img src="https://img.shields.io/badge/twitter-tweet-blue.svg?style=flat-square"/>
      </a>
      <a href="https://twitter.com/ziishaned">
        <img src="https://img.shields.io/badge/feedback-@ziishaned-blue.svg?style=flat-square" />
      </a>
        <a href="https://github.com/ziishaned/git-profile">
            <img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License">
        </a>
    </p>
    <p align="center">:octocat: Utility that helps you switch git configurations with ease</p>
</div>

## Preface

It is possible that you have multiple git configurations. For example:

```
; Office Profile
Name: John Doe
Email: johndoe@office.com

; Personal Profile
Name: John Doe
Email: johndoe@gmail.com
```

It could be a hassle to remember and switch between the profiles while working on different projects.

This utility aims to make this hassle free.

## Features

- Create and manage profiles globally; create once, use anywhere
- Set profile for a specific project
- Set global profile with a single command

This utility helps you save profiles and then you can switch between them using a single command.

## Install

```
$ composer global require zeeshan/git-profile
```
Then check your ```$PATH``` variable. It must contain ```~/.composer/vendor/bin``` dir.

```
$ echo $PATH

/usr/local/sbin:/usr/bin:/bin:/usr/sbin:/home/username/.composer/vendor/bin
```

Modify your ```.zshrc``` or ```.bashrc``` files if your ```$PATH``` variable not contain composer/bin dir.

```
export PATH=~/.composer/vendor/bin:$PATH
```

#### Also you can use .phar file

* Download the file from [here](https://github.com/ziishaned/git-profile/releases/download/v1.0/git-profile)
* `sudo chmod -R 755 git-profile`
* `sudo mv git-profile /usr/local/bin/git-profile`

## Usage

```
$ git-profile [options] <command>
```
*Options*
```
-h, --help              Display this help message
-V, --version           Display this application version
--ansi                  Force ANSI output
--no-ansi               Disable ANSI output
```
*Commands*
```
rm                      Remove git profile
use                     Change git profile locally or globally
add                     Create a new git profile
show                    Show details for an existing profile
update                  Update details for an existing profile
current                 Gets the currently set profile
list                    List of profiles
```

## Examples

Find some of the sample usages below

### Adding Profiles
```
$ git-profile add

[+] Enter profile title: Office

[+] Enter Name: John Doe
[+] Enter Email: johndoe@office.com
[+] Enter Signingkey: B7156A83

[OK] Profile "Office" saved successfully
```

### Remove Git Profile

```
$ git-profile rm "Office"

[OK] Profile "Office" successfully removed
```

### Show Details for a profile

```
$ git-profile show "Office"

[+] Name:  John Doe
[+] Email: johndoe@office.com
[+] Signingkey: B7156A83
```

### Updating Profile
```
$ git-profile update "Office"

[+] Enter Name: Jane Doe
[+] Enter Email: janedoe@gmail.com
[+] Enter Signingkey: 547ABB1C

[OK] Profile "Office" updated successfully
```

### Switching Profile

*Setting details locally i.e. set profile for the current project*
```
$ git-profile use "Office"

[OK] Switched to "Office"
```

*Setting details globally i.e. set global configuration*
```
$ git-profile use "Office" --global

[OK] Switched to "Office"
```

### Get Current Profile

```
$ git-profile current

[+] Current Profile "Office"
[+] Name: John Doe
[+] Email: johndoe@gmail.com
[+] Signingkey: 547ABB1C
```

*Side note* It should be noted that profiles are maintained globally. When you `use` some profile locally, what it does is get the configuration for that profile and sets it for the current project. i.e. when `use` is run locally it is equivalent to

```
$ git config user.name "Name for specified profile"
$ git config user.email "email-for-specified@profile.com"
$ git config user.signingkey "SIGNINGKEY"
```

### Profiles List

```
$ git-profile list

Available profiles:
    Github
    Home
    Office
```

## License

MIT © Zeeshan Ahmad
