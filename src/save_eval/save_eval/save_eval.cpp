// save_eval.cpp : ���� DLL Ӧ�ó���ĵ���������
//

#include "save_eval.h"
#include <stdio.h>

// ���ǵ���������һ��ʾ����
SAVE_EVAL_API void save_eval(char* str,int length)
{
	char sep[] = "\r\n----------------------------------\r\n\r\n";
	FILE * fp = fopen("eval_log.txt","a");
	fwrite(sep,sizeof(sep),1,fp);
	fwrite(str,1,length,fp);
	fclose(fp);
}
