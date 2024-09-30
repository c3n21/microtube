# Microtube

BE for https://github.com/dscovr/php-fs-challenge

# TODO
- better Readme
- sanitize filename and title
- remove graphql-tag
- add tags (metadata) and comments to videos

# How to run dev environment
## Development environment
```bash
cp .env.local.example .env
composer install
podman compose up # docker should be fine too
```

## Production environment
```bash
cp .env.production.example .env
podman compose up # docker should be fine too
```

# Troubleshooting

## Laravel: file_put_contents() failed to open stream: Permission denied for storage
```bash
chmod -R guo+w storage
```

# Credits
Microtube's logo is from here https://www.svgrepo.com/svg/451121/mu
