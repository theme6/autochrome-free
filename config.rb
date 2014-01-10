project_type = :stand_alone

# paths
http_path       = "/"
css_dir         = ""
sass_dir        = "sass"
images_dir      = "img"
javascripts_dir = "js"
fonts_dir		    = "fonts"

# output option: nested, expanded, compact, compressed
output_style = :expanded

# The environment mode.
# Defaults to :production, can also be :development
# Use :development to see line numbers, file names, etc
environment = :production

# To disable debugging comments that display the original location of your selectors. Uncomment:
line_comments = false

# Enable relative paths to assets via compass helper functions.
relative_assets = true

# disable the asset cache buster
asset_cache_buster :none