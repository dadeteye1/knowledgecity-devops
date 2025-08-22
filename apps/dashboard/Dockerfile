FROM node:18
WORKDIR /app
COPY server.js .
RUN npm install express node-fetch@2
CMD ["node", "server.js"]
