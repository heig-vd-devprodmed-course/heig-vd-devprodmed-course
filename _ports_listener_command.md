Mac : 

```
sudo lsof -PiTCP -sTCP:LISTEN
```

Windows : 

1. ```
   resmon (puis cliquer sur l'onglet réseau)
   ```

   ou

2. ```
   netstat -abn
   ```

   ou

3. ```
   netstat -nao
   ```

   ou

4. ```
   netstat -abn -p UDP   (ou IP, IPv6, ICMP, ICMPv6, TCP, TCPv6, UDPv6)
   ```

