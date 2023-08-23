import subprocess

def execute_powershell(command):
    result = subprocess.run(["powershell", "-Command", command], capture_output=True, text=True)
    return result.stdout

if __name__ == "__main__":
    command_output = execute_powershell("whoami")
    print(command_output)
