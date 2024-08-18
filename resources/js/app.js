import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    const experiencesSection = document.getElementById('experiences-section');
    const educationsSection = document.getElementById('educations-section');
    const languagesSection = document.getElementById('languages-section');
    const licensesSection = document.getElementById('licenses-section');
    const skillsSection = document.getElementById('skills-section');

    //ADREM EXPERIENCE BLOCK
    if (experiencesSection) {
        document.getElementById('add-experience').addEventListener('click', function(e) {
            e.preventDefault();
            const experienceCount = document.querySelectorAll('.experiences-group').length;
            const newExperiencesGroup = document.createElement('div');
            newExperiencesGroup.classList.add('experiences-group', 'mb-4');
            newExperiencesGroup.innerHTML = `
            <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                <div class="mb-4">
                    <label
                        for="experience_company_${experienceCount}"
                        class="block text-sm font-medium text-gray-700">Company</label>
                    <input
                        type="text"
                        name="experiences[${experienceCount}][experience_company]"
                        id="experience_company_${experienceCount}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        required
                        >
                </div>
                <div class="mb-4">
                    <label for="experience_position_${experienceCount}" class="block text-sm font-medium text-gray-700">Position</label>
                    <input type="text" name="experiences[${experienceCount}][experience_position]" id="experience_position_${experienceCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="experience_business_type_${experienceCount}" class="block text-sm font-medium text-gray-700">Business Type</label>
                    <input type="text" name="experiences[${experienceCount}][experience_business_type]" id="experience_business_type_${experienceCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="experience_start_date_${experienceCount}" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="experiences[${experienceCount}][experience_start_date]" id="experience_start_date_${experienceCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="experience_end_date_${experienceCount}" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" name="experiences[${experienceCount}][experience_end_date]" id="experience_end_date_${experienceCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <button
                    type="button"
                    class="remove-experience bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg"
                        >Remove Experience
                </button>
            </div>
        `;
            experiencesSection.appendChild(newExperiencesGroup);
        });
        document.getElementById('experiences-section').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-experience')) {
                e.preventDefault();
                e.target.parentElement.remove();
            }
        });
    }
    //ADREM EDUCATION BLOCK
    if (educationsSection) {
        document.getElementById('add-education').addEventListener('click', function(e) {
            e.preventDefault();
            const educationCount = document.querySelectorAll('.education-group').length;
            const newEducationGroup = document.createElement('div');
            newEducationGroup.classList.add('education-group', 'mb-4');
            newEducationGroup.innerHTML = `
            <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                <div class="mb-4">
                    <label for="education_level_${educationCount}" class="block text-sm font-medium text-gray-700">Education Level</label>
                    <input type="text" name="educations[${educationCount}][education_level]" id="education_level_${educationCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="education_institution_${educationCount}" class="block text-sm font-medium text-gray-700">Educational Institurion</label>
                    <input type="text" name="educations[${educationCount}][education_institution]" id="education_institution_${educationCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="education_start_date_${educationCount}" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="educations[${educationCount}][education_start_date]" id="education_start_date_${educationCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="education_end_date_${educationCount}" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" name="educations[${educationCount}][education_end_date]" id="education_end_date_${educationCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <button
                    type="button"
                    class="remove-education bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg"
                        >Remove Education
                </button>
            </div>
        `;
            educationsSection.appendChild(newEducationGroup);
        });
        document.getElementById('educations-section').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-education')) {
                e.preventDefault();
                e.target.parentElement.remove();
            }
        });
    }
    //ADREM LANGUAGE BLOCK
    if (languagesSection) {
        document.getElementById('add-language').addEventListener('click', function(e) {
            e.preventDefault();
            const languageCount = document.querySelectorAll('.language-group').length;
            const newLanguageGroup = document.createElement('div');
            newLanguageGroup.classList.add('language-group', 'mb-4');
            newLanguageGroup.innerHTML = `
            <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                <div class="mb-4">
                    <label for="language_name_${languageCount}" class="block text-sm font-medium text-gray-700">Language</label>
                    <input type="text" name="languages[${languageCount}][language_name]" id="language_name_${languageCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="language_level_${languageCount}" class="block text-sm font-medium text-gray-700">Langauge Level</label>
                    <input type="text" name="languages[${languageCount}][language_level]" id="language_level_${languageCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <button
                    type="button"
                    class="remove-language bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg"
                        >Remove Language
                </button>
            </div>
        `;
            languagesSection.appendChild(newLanguageGroup);
        });
        document.getElementById('languages-section').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-language')) {
                e.preventDefault();
                e.target.parentElement.remove();
            }
        });
    }
    //ADREM LICENSES BLOCK
    if (licensesSection) {
        document.getElementById('add-licenses').addEventListener('click', function(e) {
            e.preventDefault();
            const licenseCount = document.querySelectorAll('.license-group').length;
            const newLicensesGroup = document.createElement('div');
            newLicensesGroup.classList.add('license-group', 'mb-4');
            newLicensesGroup.innerHTML = `
            <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                <div class="mb-4">
                    <label for="license_name_${licenseCount}" class="block text-sm font-medium text-gray-700">License Name</label>
                    <input type="text" name="licenses[${licenseCount}][license_name]" id="license_name_${licenseCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="license_institution_${licenseCount}" class="block text-sm font-medium text-gray-700">Issuer</label>
                    <input type="text" name="licenses[${licenseCount}][license_institution]" id="license_institution_${licenseCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="license_id_${licenseCount}" class="block text-sm font-medium text-gray-700">License ID</label>
                    <input type="text" name="licenses[${licenseCount}][license_id]" id="license_id_${licenseCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="license_issue_date_${licenseCount}" class="block text-sm font-medium text-gray-700">Issue Date</label>
                    <input type="date" name="licenses[${licenseCount}][license_issue_date]" id="license_issue_date_${licenseCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <button
                    type="button"
                    class="remove-license bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg"
                        >Remove License
                </button>
            </div>
        `;
            licensesSection.appendChild(newLicensesGroup);
        });
        document.getElementById('licenses-section').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-license')) {
                e.preventDefault();
                e.target.parentElement.remove();
            }
        });
    }
    //ADREM SKILL BLOCK
    if (skillsSection) {
        document.getElementById('add-skill').addEventListener('click', function(e) {
            e.preventDefault();
            const skillCount = document.querySelectorAll('.skill-group').length;
            const newSkillGroup = document.createElement('div');
            newSkillGroup.classList.add('skill-group', 'mb-4');
            newSkillGroup.innerHTML = `
            <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                <div class="mb-4">
                    <label for="skill_name_${skillCount}" class="block text-sm font-medium text-gray-700">Skill</label>
                    <input type="text" name="skills[${skillCount}][skill_name]" id="skill_name_${skillCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="skill_level_${skillCount}" class="block text-sm font-medium text-gray-700">Skill Level</label>
                    <input type="text" name="skills[${skillCount}][skill_level]" id="skill_level_${skillCount}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <button
                    type="button"
                    class="remove-skill bg-red-600 text-white px-3 py-2 border border-red-500 rounded-lg"
                        >Remove Skill
                </button>
            </div>
        `;
            skillsSection.appendChild(newSkillGroup);
        });
        document.getElementById('skills-section').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-skill')) {
                e.preventDefault();
                e.target.parentElement.remove();
            }
        });
    }
});
