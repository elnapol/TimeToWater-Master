#include <ESP8266WiFi.h>
#include <DHT.h>

//const char* ssid = "CASANAPOLITANO.";
//const char* password = "0198201982";
const int ledPIN = 9;
const char* ssid = "Napo";
const char* password = "qweasdzxc1";

const char* host = "timetowater.napotex.cl";
  
const int DHTPIN=2; // D2 en node

DHT dht(DHTPIN, DHT11, 11); // 11 works fine for ESP8266

/*** Variables para Humedad y Temperatura ****/
float temperatura;
float humedad;
float humedadTi;

void setup()
{
  Serial.begin(115200);
  Serial.println();

  dht.begin();
  pinMode(5,OUTPUT);
  digitalWrite(5,LOW);

  Serial.printf("Connecting to %s ", ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println(" connected");
}

void loop()
{
  WiFiClient client;

  Serial.printf("\n[Connecting to %s ... ", host);
  if (client.connect(host, 80))
  {
    Serial.println("connected]");
    temperatura=0;
    humedad=0;
    humedadTi=0;
    
    temperatura = dht.readTemperature();
    humedad = dht.readHumidity();
    humedadTi = analogRead(A0);
    Serial.print("Moisture Sensor Value: ");
    Serial.println("[Sending a request]");
    delay(1000);
     
    client.print(String("GET /recepcion/llamadasBD.php?T=") + temperatura + "&H=" + humedad + "&H2=" + humedadTi + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n" +
                 "\r\n"
                );

    Serial.println("[Response:]");
    while (client.connected())
    {
      if (client.available())
      {
        String line = client.readStringUntil('\n');
      /*  if (line.substring(line.indexOf('T'),line.indexOf('T')+24) == "Tu IP p&uacute;blica es:") {
          Serial.print("CADENA ENCONTRADA --> ");
          Serial.println(line.substring(line.indexOf(':')+2,line.length()-5));
          Serial.print(" <-- CADENA ENCONTRADA");
        }
        */
        Serial.println(line);
      }
    }
    client.stop();
    Serial.println(temperatura);
    Serial.println(humedad);
    Serial.println(humedadTi);
    
    Serial.println("\n[Disconnected]");
  }
  else
  {
    Serial.println("connection failed!]");
    client.stop();
  }
  digitalWrite(5,HIGH); // toggle pin    
  delay(1000);                       // wait for a second
  digitalWrite(5,LOW); // toggle pin    
  delay(8000);                       // wait for a second
  
}
