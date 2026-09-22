# SAST (Semgrep) — Before vs After

**Tool:** Semgrep 1.177.0 (community ruleset, `--config=auto`)
**Target directory:** `vulnerabilities/exec/`
**Files scanned:** 6
**Rules run:** 85

## Findings by file

| File | Before | After |
|------|--------|-------|
| `low.php` | 6 | 2 |
| `medium.php` | 6 | 6 |
| `high.php` | 6 | 6 |
| `impossible.php` | 6 | 6 |
| **Total** | **24** | **20** |

## `low.php` — detailed breakdown

| Semgrep Rule | Before | After |
|--------------|--------|-------|
| `php.lang.security.injection.tainted-exec` | 2 (lines 6, 9) | 0 (eliminated) |
| `php.lang.security.tainted-exec` | 2 (lines 6, 9) | 0 (eliminated) |
| `php.lang.security.exec-use.exec-use` | 2 (lines 6, 9) | 2 (residual) |

## Interpretation

- **Eliminated:** The two taint-tracking rules that detect user input flowing
  into a shell command. This confirms the fix removes the command injection
  vulnerability at the data-flow level.

- **Residual exec-use:** Semgrep flags any call to `shell_exec()` even when
  the argument is provably safe. This is a known false-positive pattern — the
  rule cannot verify upstream sanitization in all cases.

- **Lesson:** Static analysis is a signal, not a guarantee. It requires human
  review to triage false positives. A robust DevSecOps pipeline combines SAST
  with human review, DAST, dependency scanning, and container scanning.

## Semgrep Rules Triggered

| Rule | Purpose | URL |
|------|---------|-----|
| `php.lang.security.exec-use.exec-use` | Detects `shell_exec()` calls | https://sg.run/5Q1j |
| `php.lang.security.injection.tainted-exec` | Tracks user input to shell | https://sg.run/kxEEz |
| `php.lang.security.tainted-exec` | Warns on unescaped shell args | https://sg.run/JAkP |
