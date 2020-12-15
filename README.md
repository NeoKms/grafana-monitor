# Практикум разработки с Docker
Автор - Жигульский В.Е.

## Для запуска первой части запускать через докер композ прод или дев сервер (графана так и не заработала).

## Для запуска второй части запускать sh dockerup.sh в корне папки

## Для запуска третьей части выполнить init.sh, чтобы докер сделал все сам, либо недостающие команды:

Создаем реестр и инитим рой: docker swarm init && docker service create --name registry --publish published=5000,target=5000 registry:2

Пушим в локальный реестр свои образы: docker-compose build && docker-compose push

Запускаем сервис: docker stack deploy --compose-file docker-compose.yml stackdemo && docker stack services stackdemo
