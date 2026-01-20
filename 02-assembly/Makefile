hello_world: hello_world.asm
	nasm -f elf64 hello_world.asm
	ld -o hello hello_world.o
	rm -fr hello_world.o
check: check.asm
	nasm -f elf64 check.asm
	ld -o check check.o
	rm -fr check.o
