#include <wiringPi.h>
int a;

int cleanup()
{
digitalWrite (21, LOW);
digitalWrite (6, LOW);
return 0;
}

int main (void)
{
  wiringPiSetupGpio () ;
  pinMode (21, OUTPUT) ;
  pinMode (20, INPUT) ;
  pinMode (6, OUTPUT) ;
  pullUpDnControl (20, PUD_UP);
  for (a = 0; a < 10; a++)
  {
    digitalWrite (21, HIGH) ; delay (500) ;
    digitalWrite (21,  LOW) ; delay (500) ;
  }
while(true){
  if (digitalRead (20) == 1){
  digitalWrite (21, HIGH) ; delay (500) ;
  digitalWrite (21,  LOW) ; delay (500) ;
}  
  else{
  delay (500); 
    digitalWrite (6, HIGH) ; delay (500) ;
    digitalWrite (6,  LOW) ; delay (500) ;
  }
}
  cleanup();
  return 0 ;
}
