DB_USER=user
DB_PASSWORD=password
DB_NAME=db
SQL_FILE=sql/schema.sql

.PHONY: start

start:
	docker compose up -d db
	@echo "Waiting for MySQL..."
	@until docker compose exec db mysql -u $(DB_USER) -p$(DB_PASSWORD) -e "SELECT 1" >/dev/null 2>&1; do \
		sleep 2; \
	done
	@echo "Database is up. Applying schema..."
	docker compose exec -T db mysql -u $(DB_USER) -p$(DB_PASSWORD) $(DB_NAME) < $(SQL_FILE)
	@echo "Done."
