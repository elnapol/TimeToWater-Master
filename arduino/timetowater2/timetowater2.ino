#include <DHT.h>
#include <ESP8266WiFi.h>

//const char* ssid = "CASANAPOLITANO.";
//const char* password = "0198201982";
const int ledPIN = 9,comparar=1;
const char* ssid = "Napo";
const char* password = "qweasdzxc1";

const char* host = "timetowater2.napotex.cl";
  
const int DHTPIN=2; // D2 en node

DHT dht(DHTPIN, DHT11, 11); // 11 works fine for ESP8266

/*** Variables para Humedad y Temperatura ****/
float temperatura;
float humedad;
float humedadTi;
String estado;
const int rele1 = 4, rele2 = 5;
void setup()
{
  Serial.begin(115200);
  Serial.println();

  dht.begin();
  pinMode(rele1,OUTPUT);
  pinMode(rele2,OUTPUT);


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
        
        if (line.substring(line.indexOf('E'),line.indexOf('E')+7) == "Estado:") {
            Serial.println(line.substring(line.indexOf(':')+1,line.length()));
            estado= line.substring(line.indexOf(':')+1,line.length());
        }       
        Serial.println(line);
      }
    }
    client.stop();
    Serial.println("\n[Disconnected]");
    Serial.print("Temperatura: ");
    Serial.println(temperatura);
    Serial.print("Humedad: ");
    Serial.println(humedad);
    Serial.print("Humedad Piso: ");
    Serial.println(humedadTi);
    Serial.print("Estado actuador: ");
    Serial.println(estado);
    
  }
  else
  {
    Serial.println("connection failed!]");
    client.stop();
  }
  
  
  if( estado. toInt ( ) == comparar ){
    digitalWrite(rele1,LOW); // apagar pin    
    digitalWrite(rele2, LOW);
    delay(1000);// esperar 1 second
  }else{
    digitalWrite(rele1,HIGH); // prender pin  
    digitalWrite(rele2, HIGH);    
    delay(1000); 
  }
}

