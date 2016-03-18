FROM mhart/alpine-node:4
# FROM mhart/alpine-node:base-0.10
# FROM mhart/alpine-node
# https://github.com/mhart/alpine-node

WORKDIR /src
ADD ./src* ./src

# If you have native dependencies, you'll need extra tools
# RUN apk add --no-cache make gcc g++ python

# If you need npm, don't use a base tag
RUN npm install

# install Process Manager. For more information, see https://github.com/Unitech/pm2.
RUN npm install pm2 -g
EXPOSE 3000
CMD ["pm2", "ecosystem.json"]