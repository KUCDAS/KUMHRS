#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define MAX_LINE_LENGTH 1024

// Function to compare two text files line by line
void compareTextFiles(const char *file1, const char *file2) {
    FILE *fp1, *fp2;
    char line1[MAX_LINE_LENGTH], line2[MAX_LINE_LENGTH];
    int lineNum = 0, diffCount = 0;

    fp1 = fopen(file1, "r");
    if (fp1 == NULL) {
        perror("Error opening file 1");
        return;
    }

    fp2 = fopen(file2, "r");
    if (fp2 == NULL) {
        perror("Error opening file 2");
        fclose(fp1);
        return;
    }

    while (fgets(line1, MAX_LINE_LENGTH, fp1) != NULL &&
           fgets(line2, MAX_LINE_LENGTH, fp2) != NULL) {
        lineNum++;
        if (strcmp(line1, line2) != 0) {
            printf("%s:Line %d: %s", file1, lineNum, line1);
            printf("%s:Line %d: %s", file2, lineNum, line2);
            diffCount++;
        }
    }

    fclose(fp1);
    fclose(fp2);

    if (diffCount == 0) {
        printf("The two text files are identical\n");
    } else {
        printf("%d different lines found\n", diffCount);
    }
}

// Function to compare two binary files byte by byte
void compareBinaryFiles(const char *file1, const char *file2) {
    FILE *fp1, *fp2;
    int byte1, byte2;
    long diffCount = 0;

    fp1 = fopen(file1, "rb");
    if (fp1 == NULL) {
        perror("Error opening file 1");
        return;
    }

    fp2 = fopen(file2, "rb");
    if (fp2 == NULL) {
        perror("Error opening file 2");
        fclose(fp1);
        return;
    }

    while ((byte1 = fgetc(fp1)) != EOF && (byte2 = fgetc(fp2)) != EOF) {
        if (byte1 != byte2) {
            diffCount++;
        }
    }

    fclose(fp1);
    fclose(fp2);

    if (diffCount == 0) {
        printf("The two files are identical\n");
    } else {
        printf("The two files are different in %ld bytes\n", diffCount);
    }
}

int main(int argc, char *argv[]) {
    // Check for correct number of arguments
    if (argc < 3) {
        printf("Usage: %s [-a | -b] file1 file2\n", argv[0]);
        return 1;
    }

    // Default mode is -a
    int mode = 0; // 0 for text mode, 1 for binary mode
    if (argc > 3 && strcmp(argv[1], "-b") == 0) {
        mode = 1;
    }

    const char *file1 = argv[argc - 2];
    const char *file2 = argv[argc - 1];

    // Check file extensions if in text mode
    if (mode == 0) {
        const char *ext1 = strrchr(file1, '.');
        const char *ext2 = strrchr(file2, '.');
        if (ext1 == NULL || ext2 == NULL || strcmp(ext1, ".txt") != 0 || strcmp(ext2, ".txt") != 0) {
            printf("Error: Text mode requires files with .txt extension\n");
            return 1;
        }
    }

    // Perform comparison based on mode
    if (mode == 0) {
        compareTextFiles(file1, file2);
    } else {
        compareBinaryFiles(file1, file2);
    }

    return 0;
}