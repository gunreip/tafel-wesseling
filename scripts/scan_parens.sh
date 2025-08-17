#!/usr/bin/env bash
set -Eeuo pipefail

# Wurzeln, die wir scannen (Projektdateien); vendor/node_modules lassen wir aus.
roots=(app config database routes resources)

total=0
mismatches=0

echo "=== PAREN SCAN ($(date)) ==="
echo "Roots: ${roots[*]}"
echo

# Dateien einsammeln (php + blade + js/ts/vue/css/html – falls gewünscht)
while IFS= read -r -d '' f; do
  total=$((total+1))
  # Klammern zählen
  opens=$(tr -cd '(' < "$f" | wc -c | xargs)
  closes=$(tr -cd ')' < "$f" | wc -c | xargs)
  if [ "$opens" -ne "$closes" ]; then
    mismatches=$((mismatches+1))
    delta=$((opens - closes))
    printf 'PAREN ❌  %s  ( (=%s, )=%s, Δ=%+d )\n' "$f" "$opens" "$closes" "$delta"
  fi
done < <(find "${roots[@]}" -type f \( -name '*.php' -o -name '*.blade.php' -o -name '*.js' -o -name '*.ts' -o -name '*.vue' -o -name '*.css' -o -name '*.html' \) \
          -not -path '*/vendor/*' -not -path '*/node_modules/*' -not -path '*/storage/*' -not -path '*/bootstrap/cache/*' -print0 | sort -z)

echo
if [ "$mismatches" -eq 0 ]; then
  echo "PAREN ✅  keine Abweichungen gefunden (Dateien geprüft: $total)"
else
  echo "PAREN ⚠️   Abweichungen: $mismatches  (Dateien geprüft: $total)"
fi
