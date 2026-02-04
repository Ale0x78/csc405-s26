shellcode:
	gcc -no-pie -c ./shellcode.s -o shellcode.o

shelltest: shelltest.c shellcode.o
	gcc shelltest.c -o shelltest -fno-stack-protector -z execstack -no-pie

rip:
	objdump -z -d shellcode.o | python3 shellcode_extractor.py
