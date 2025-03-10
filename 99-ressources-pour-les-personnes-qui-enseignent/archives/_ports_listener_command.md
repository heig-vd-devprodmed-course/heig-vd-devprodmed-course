# Ports listener command

## Mac

```bash
sudo lsof -PiTCP -sTCP:LISTEN
```

## Windows

1. ```bash
   resmon (puis cliquer sur l'onglet réseau)
   ```

   ou

2. ```bash
   netstat -abn
   ```

   ou

3. ```bash
   netstat -nao
   ```

   ou

4. ```bash
   netstat -abn -p UDP   (ou IP, IPv6, ICMP, ICMPv6, TCP, TCPv6, UDPv6)
   ```
