#!/usr/bin/env sh

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
php -S localhost:8000 "$DIR/../src/TicTacToe/StaticWeb/App.php"

