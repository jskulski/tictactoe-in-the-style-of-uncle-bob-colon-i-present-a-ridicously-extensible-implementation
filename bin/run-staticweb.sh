#!/usr/bin/env sh

SCRIPT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
cd "$SCRIPT_DIR/../src/TicTacToe/StaticWeb/" && php -S localhost:8000

