## Prerequisites

- [Docker](https://www.docker.com/)

---

## Getting Started

### Build the containers

```bash
docker compose build
```
### Install composer dependencies
```bash
docker compose run --rm php composer install
```

### Run the containers
```
docker compose up -d
```

### Running Tests

```bash
docker compose run --rm php composer test
```