THEMES
======

Repository of Princeton-flavored bottstrap-sass themes.

How to use these themes:

```$ gem update --system```

```$ gem install bootstrap-sass```

```$ gem install compass```

```$ cd themes/<my_theme>```

```$ compass install compass```

```$ compass watch```

Now any changes you make to the themes/<my_theme>/sass/styles.scss file will be compiled. 

To create your own theme, copy another theme into a new directory, and delete everything in styles.scss to start from a blank bootstrap slate.  Or you can try your hand at creating your theme as a new compass project with the [compass create](http://compass-style.org/install/) command.

# Using Font-Awesome

In order to use Font-Awesome, you will need to actually edit a few files in the bootstrap-sass gem.

Find where your gems are kept by typing: ```$ gem env```

Go into the bootstrap-sass gem and under ```vendor/assets/stylesheets```, overwrite bootstrap.scss with the ```bootstrap.scss``` file found in the ```font-awesome-assets``` folder of this repo.  Copy the other two files (```_font-awesome.scss``` and ```bootstrap-fa.scss```) into the 
```vendor/assets/stylesheets/bootstrap``` folder.

