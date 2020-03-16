package chapter02.exercise_2_19_tobinary;

import java.util.Scanner;

public class ToBinaryString {

	public static void main(String[] args) {
		
		System.out.println("정수를 입력하면 이진법으로 바꾸겠다. : ");
		Scanner scanner = new Scanner(System.in);
		int number = scanner.nextInt();
		String string=toBinaryString(number) ;
		System.out.println(number + " 이진법으로 변환하면 : " + string);
	}
	
	public static String toBinaryString(int number) {
		String string = Integer.toBinaryString(number);
		
		while(string.length()<32) {
			string = "0"+string;
		}
		return string;
	}

}
