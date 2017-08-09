#include <wiringPi.h>
int a;
int b;

int cleanup()
{
  digitalWrite (21, LOW);
  digitalWrite (6, LOW);
  return 0;
}

int buzz(){
  digitalWrite (21, HIGH) ; delay (500) ;
  digitalWrite (21,  LOW) ; delay (300) ;
  return 0;
}

int zone1(){
  buzz();
  return 0;
}

int zone2(){
  for (b = 0; b < 2; b++){
  buzz();
 }
  return 0;
  }

int zone3(){
  for (b = 0; b < 3; b++){
  buzz();
  }
  return 0;
}

int zone4(){
  for (b = 0; b < 4; b++){
  buzz();
  }
  return 0;
}

int zone5(){
  for (b = 0; b < 5; b++){
  buzz();
  }
  return 0;
}

int zone6(){
  for (b = 0; b < 6; b++){
  buzz();
  }
  return 0;
}

int zone7(){
  for (b = 0; b < 7; b++){
  buzz();
  }
  return 0;
}

int zone8(){
  for (b = 0; b < 8; b++){
  buzz();
  }
  return 0;
}

int blink(){
  digitalWrite (6, HIGH) ; delay (500) ;
  digitalWrite (6,  LOW) ; delay (500) ;
  return 0;
}

int main (void)
{
  wiringPiSetupGpio () ;
  pinMode (1, INPUT) ; //Zone 1 input
  pinMode (7, INPUT) ; //Zone 2 input
  pinMode(8, INPUT) ; //Zone 3 input
  pinMode(24, INPUT); //Zone 4 input'
  pinMode(23, INPUT); //Zone 5 input
  pinMode (20, INPUT) ; //Zone 6 input
  pinMode(16, INPUT); //Zone 7 input
  pinMode(12, INPUT); //Zone 8 input
  pinMode (21, OUTPUT) ; //Buzzer output
  pinMode (6, OUTPUT) ; //Green LED
  pullUpDnControl (1, PUD_UP) ; //Zone 1 Pull up
  pullUpDnControl (7, PUD_UP) ; //Zone 2 Pull up
  pullUpDnControl(8, PUD_UP); //Zone 3 Pull up
  pullUpDnControl(24, PUD_UP); //Zone 4 Pull up
  pullUpDnControl(23, PUD_UP); //Zone 5 Pull up
  pullUpDnControl (20, PUD_UP); //Zone 6 Pull up
  pullUpDnControl(16, PUD_UP); //Zone 7 Pull up
  pullUpDnControl(12, PUD_UP); //Zone 8 Pull up
  for (a = 0; a < 5; a++)
  {
    digitalWrite (21, HIGH) ; delay (1000) ;
    digitalWrite (21,  LOW) ; delay (500) ;
  }
while(true){
  delay (500);
  if (digitalRead (20) == 1){
  zone6();
}
  if (digitalRead(1) == 1){
  zone1();
  }
  if (digitalRead(7) == 1){
  zone2();
  }
  if (digitalRead(8) == 1){
  zone3();
  }
  if (digitalRead(24) == 1){
  zone4();
  }
  if (digitalRead(23) == 1){
  zone5();
  }
//  if (digitalRead(16) == 1){
//  zone7();
//  }
//  if (digitalRead(12) == 1){
//  zone8();
//  }
  else{
  delay (500);
  blink();
  }
}
  return 0 ;
}
