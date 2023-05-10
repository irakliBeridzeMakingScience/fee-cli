##################
# Variables
##################

CONTAINER_TAG = fee-calculator
DOCKER_RUN = docker run -it --rm  ${CONTAINER_TAG}

##################
# Docker
##################

build:
	docker build -t ${CONTAINER_TAG} .

##################
# App
##################

csv-parse:
	${DOCKER_RUN} csv:parse $(file)


test:
	${DOCKER_RUN} test --testsuite=Feature
