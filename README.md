# git-profile

> Utility that helps you switch git configurations with ease

## Preface

It is possible that you have multiple git configurations. For example

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

## Usage

```
$ git profile [options] <command>
```
*Options*
```
-h, --help              Display this help message
-V, --version           Display this application version
--ansi                  Force ANSI output
--no-ansi               Disable ANSI output
```
*Command*
```
current                 Gets the currently set profile
show 					Show details for an existing profile
update 					Update details for an existing profile
rm                      Remove git profile
add                     Create a new git profile
use                     Change git profile locally or globally
```


## Examples

Find some of the sample usages below

### Adding Profiles
```
$ git profile add

[+] Enter profile title: Office

[+] Enter Name:  John Doe
[+] Enter Email: johndoe@office.com

[OK] Profile "Office" saved successfully
```

### Remove Git Profile

```
$ git profile rm "Office"

[OK] Profile "Office" successfully removed 
```

### Show Details for a profile

```
$ git profile show "Office"

[+] Name:  John Doe
[+] Email: johndoe@office.com 
```

### Updating Profile
```
$ git profile update "Office"

[+] Enter Name:  Jane Doe
[+] Enter Email: janedoe@gmail.com

[OK] Profile "Office" updated successfully
```

### Switching Profile

*Setting details locally i.e. set profile for the current project*
```
$ git profile use "Office"

[OK] Switched to "Office"
```

*Setting details globally i.e. set global configuration*
```
$ git profile use "Office" --global

[OK] Switched to "Office"
```

### Get Current Profile

```
$ git profile current

[+] Current Profile "Office"
[+] Name: John Doe
[+] Email: johndoe@gmail.com
```

*Side note* It should be noted that profiles are maintained globally. When you `use` some profile locally, what it does is get the configuration for that profile and sets it for the current project. i.e. when `use` is run locally it is equivalent to

```
git config user.name "Name for specified profile"
git config user.email "email-for-specified@profile.com"
```

## License

MIT © Zeeshan Ahmed
