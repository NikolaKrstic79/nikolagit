let num = 13;
let num2 = 15;
let num3 = 20;

let arr = [num, num2, num3];
arr.sort((a,b) => a - b);

// 
let smallest = arr [0];
let largest = arr[arr.length - 1];
// 
function isPrime(n){
    if (n <= 1) {
        return false;
    }
    for (let i = 2; i <= Math.sqrt(n); i++) {
        if (n % i === 0){
            return false;
        }
    }
    return true;
}
// 
let smallestIsPrime = isPrime(smallest);
let largestIsPrime = isPrime(largest);
// 
console.log(`Smallest - ${smallest} , Largest-${largest}`);
console.log(`The smallest number ${smallest} is ${smallestIsPrime ? 'prime' : 'not prime'} , ` +
 `The largest number ${largest} is ${largestIsPrime ? 'prime' : 'not prime'}`);