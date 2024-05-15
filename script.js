function goToStep(stepNumber) {
    // Hide all steps
    const totalSteps = 5; // assuming there are 5 steps
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById('step' + i).style.display = 'none';
    }
    // Show current step
    document.getElementById('step' + stepNumber).style.display = 'block';
}
