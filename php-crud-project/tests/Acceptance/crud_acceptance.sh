#!/usr/bin/env bash
set -euo pipefail

BASE_URL="${1:-http://localhost:8000}"

echo "1) GET /tasks"
curl -sS "$BASE_URL/tasks" > /dev/null
echo "OK"

echo "2) POST /tasks/create (create)"
curl -sS -X POST "$BASE_URL/tasks/create" \
  -d "title=Acceptatie%20taak&description=via%20script" \
  -o /dev/null -w "%{http_code}\n" | grep -q "302"
echo "OK (redirect)"

echo "Let op: Update/Delete via script vereist id uitlezen uit HTML. Doe dat handmatig of breid dit script uit."
