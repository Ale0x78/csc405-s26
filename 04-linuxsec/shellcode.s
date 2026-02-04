.section .text
.globl _start

_start:
    xor %rax, %rax
    push %rax
    
    movq $0x2F62696E2F7368, %rbx
    push %rbx
    
    mov %rsp, %rdi
    
    push %rax
    push %rdi
    mov %rsp, %rsi
    
    xor %rdx, %rdx
    
    mov $59, %al
    syscall
