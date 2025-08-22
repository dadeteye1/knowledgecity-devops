FROM ubuntu:22.04
RUN apt-get update && apt-get install -y ffmpeg bash
WORKDIR /app
COPY encode.sh /app/encode.sh
RUN chmod +x /app/encode.sh
CMD ["/app/encode.sh"]
